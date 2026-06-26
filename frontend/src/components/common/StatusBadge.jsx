const colors = {
  apto: 'success',
  pendiente: 'warning',
  no_apto: 'danger',
  vigente: 'success',
  vencida: 'danger',
  suspendida: 'secondary',
  sin_licencia: 'dark',
  en_proceso: 'info',
  resuelto: 'success',
  rechazado: 'secondary',
};

const labels = {
  no_apto: 'No apto',
  sin_licencia: 'Sin licencia',
  en_proceso: 'En proceso',
};

export function StatusBadge({ value }) {
  const variant = colors[value] || 'primary';
  const label = labels[value] || value?.replace('_', ' ');

  return <span className={`badge text-bg-${variant}`}>{label}</span>;
}

