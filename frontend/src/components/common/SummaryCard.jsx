export function SummaryCard({ icon, title, value, subtitle, color = 'primary' }) {
  return (
    <div className="card stat-card h-100">
      <div className="card-body">
        <div className="d-flex justify-content-between align-items-start">
          <div>
            <p className="text-secondary small mb-2">{title}</p>
            <h3 className="fw-bold mb-1">{value}</h3>
            <p className="text-muted small mb-0">{subtitle}</p>
          </div>
          <div className={`bg-${color} bg-opacity-10 text-${color} rounded-4 px-3 py-2`}>
            <i className={`bi ${icon} fs-4`} />
          </div>
        </div>
      </div>
    </div>
  );
}

