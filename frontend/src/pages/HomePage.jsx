import { Link } from 'react-router-dom';
import { SummaryCard } from '../components/common/SummaryCard';

export function HomePage() {
  return (
    <div className="container-fluid">
      <div className="card hero-card mb-4">
        <div className="card-body p-4 p-lg-5">
          <div className="row align-items-center">
            <div className="col-lg-8">
              <span className="badge text-bg-primary mb-3">MVP listo para municipios y fiscalización</span>
              <h1 className="display-6 fw-bold">Registro y control sanitario de vendedores de ceviche ambulante</h1>
              <p className="lead text-secondary mt-3">
                Consulta puestos, revisa licencias, registra inspecciones y recibe reportes ciudadanos en una sola plataforma.
              </p>
              <div className="d-flex gap-3 flex-wrap mt-4">
                <Link className="btn btn-primary btn-lg" to="/vendors">
                  Explorar vendedores
                </Link>
                <Link className="btn btn-outline-primary btn-lg" to="/reports/new">
                  Registrar reporte
                </Link>
              </div>
            </div>
            <div className="col-lg-4 mt-4 mt-lg-0">
              <div className="bg-primary bg-opacity-10 rounded-4 p-4">
                <h5 className="fw-bold">Estados sanitarios</h5>
                <p className="mb-2"><span className="badge text-bg-success">Apto</span> Venta autorizada.</p>
                <p className="mb-2"><span className="badge text-bg-warning">Pendiente</span> Observaciones por subsanar.</p>
                <p className="mb-0"><span className="badge text-bg-danger">No apto</span> Riesgo sanitario detectado.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div className="row g-4">
        <div className="col-md-6 col-xl-3">
          <SummaryCard icon="bi-people-fill" title="Vendedores registrados" value="5+" subtitle="Base inicial de prueba" />
        </div>
        <div className="col-md-6 col-xl-3">
          <SummaryCard icon="bi-shop-window" title="Puestos monitoreados" value="8" subtitle="Con estado sanitario visible" color="info" />
        </div>
        <div className="col-md-6 col-xl-3">
          <SummaryCard icon="bi-clipboard2-check" title="Inspecciones" value="6" subtitle="Seguimiento municipal" color="success" />
        </div>
        <div className="col-md-6 col-xl-3">
          <SummaryCard icon="bi-megaphone-fill" title="Reportes ciudadanos" value="10" subtitle="Participación comunitaria" color="warning" />
        </div>
      </div>
    </div>
  );
}

