@php
    function money_cop($v) { return '$' . number_format((float) $v, 0, ',', '.'); }
@endphp

<style>
/* ===== Estilos aislados para esta vista ===== */
.invoices {
  --bg-card: rgba(255,255,255,.04);
  --bg-card-strong: rgba(255,255,255,.06);
  --bg-hover: rgba(255,255,255,.07);
  --border: 1px solid rgba(255,255,255,.12);
  --text-soft: rgba(255,255,255,.7);
  --radius: 14px;
  --shadow: 0 4px 18px rgba(0,0,0,.18);
  --mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
  color: inherit;
}

/* Resumen (cards) */
.invoices .cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 14px;
  margin-bottom: 18px;
}
.invoices .card {
  background: var(--bg-card);
  border: var(--border);
  border-radius: var(--radius);
  padding: 14px 16px;
  box-shadow: var(--shadow);
}
.invoices .card .k { font-size: 12px; color: var(--text-soft); }
.invoices .card .v { margin-top: 6px; font-size: 22px; font-weight: 700; letter-spacing: .2px; }

/* Tabla */
.invoices .table-wrap {
  border: var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  background: var(--bg-card);
  box-shadow: var(--shadow);
}
.invoices .table-scroll { overflow:auto; }
.invoices table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  font-size: 14px;
  min-width: 760px;           /* scroll horizontal si es necesario */
}
.invoices thead th {
  text-align: left;
  font-weight: 700;
  padding: 10px 12px;
  background: var(--bg-card-strong);
  position: sticky; top: 0; z-index: 1;
}
.invoices th:first-child { padding-left: 16px; }
.invoices th:last-child  { padding-right:16px; }

.invoices tbody td, .invoices tfoot td {
  padding: 10px 12px;
  border-top: 1px solid rgba(255,255,255,.06);
}
.invoices tbody tr:hover { background: var(--bg-hover); }
.invoices tbody tr:nth-child(odd) { background: rgba(255,255,255,.02); }

.invoices .num { font-family: var(--mono); font-variant-numeric: tabular-nums; text-align: right; }

.invoices tfoot td {
  font-weight: 700;
  background: var(--bg-card-strong);
}
.invoices tfoot td:first-child { padding-left:16px; }
.invoices tfoot td:last-child  { padding-right:16px; }

/* Badges de estado */
.invoices .badge {
  display: inline-flex; gap:6px; align-items:center;
  padding: 4px 8px; border-radius: 999px; font-size: 12px; font-weight: 600;
}
.invoices .dot { width:6px; height:6px; border-radius:50%; opacity:.8; }
.invoices .is-pendiente { background: #fde68a22; color:#fcd34d; }
.invoices .is-pendiente .dot { background:#fbbf24; }

.invoices .is-parcial   { background:#93c5fd22; color:#93c5fd; }
.invoices .is-parcial .dot { background:#60a5fa; }

.invoices .is-pagada    { background:#6ee7b722; color:#6ee7b7; }
.invoices .is-pagada .dot { background:#34d399; }

.invoices .is-anulada   { background:#9ca3af22; color:#cbd5e1; }
.invoices .is-anulada .dot { background:#9ca3af; }

/* Botón */
.invoices .btn {
  display:inline-flex; align-items:center; gap:6px;
  padding: 6px 10px; font-size:12px; font-weight:600;
  border-radius:8px; border: 1px solid rgba(255,255,255,.18);
  background: transparent; color: inherit; text-decoration:none;
}
.invoices .btn:hover { background: var(--bg-hover); }

/* Encabezado de sección (opcional) */
.invoices .title { font-size: 18px; font-weight: 700; margin: 0 0 10px 0; }
</style>

<div class="invoices">
    <!-- Resumen -->
    <div class="cards">
        <div class="card">
            <div class="k">Total facturado</div>
            <div class="v">{{ money_cop($totalFacturas) }}</div>
        </div>
        <div class="card">
            <div class="k">Total abonos</div>
            <div class="v">{{ money_cop($totalAbonos) }}</div>
        </div>
        <div class="card">
            <div class="k">Saldo</div>
            <div class="v">{{ money_cop($totalSaldo) }}</div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="table-wrap">
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Remisión</th>
                        <th>Fecha</th>
                        <th class="num">Total</th>
                        <th class="num">Abonos</th>
                        <th class="num">Saldo</th>
                        <th>Estado</th>
                        <th style="text-align:left;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($invoices as $inv)
                    @php
                        $abonos = (float) ($inv->payments_sum_amount ?? 0);
                        $saldo  = max(0, (float) $inv->total - $abonos);
                        $status = strtolower($inv->status ?? '');
                        $badgeClass = match($status) {
                            'pendiente' => 'is-pendiente',
                            'parcial'   => 'is-parcial',
                            'pagada'    => 'is-pagada',
                            'anulada'   => 'is-anulada',
                            default     => 'is-parcial',
                        };
                    @endphp
                    <tr>
                        <td style="padding-left:16px; font-weight:600;">{{ $inv->remision }}</td>
                        <td>{{ optional($inv->date)->format('Y-m-d') }}</td>
                        <td class="num">{{ money_cop($inv->total) }}</td>
                        <td class="num">{{ money_cop($abonos) }}</td>
                        <td class="num">{{ money_cop($saldo) }}</td>
                        <td>
                            <span class="badge {{ $badgeClass }}">
                                <span class="dot"></span>{{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            <a class="btn"
                               href="{{ \App\Filament\Resources\Payments\PaymentResource::getUrl('create', ['invoice_id' => $inv->id]) }}">
                                Abonar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:16px; text-align:center; color:var(--text-soft);">
                            No hay facturas para mostrar.
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td style="padding-left:16px; font-weight:700;">Totales</td>
                        <td></td>
                        <td class="num">{{ money_cop($totalFacturas) }}</td>
                        <td class="num">{{ money_cop($totalAbonos) }}</td>
                        <td class="num">{{ money_cop($totalSaldo) }}</td>
                        <td></td>
                        <td style="padding-right:16px;"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
