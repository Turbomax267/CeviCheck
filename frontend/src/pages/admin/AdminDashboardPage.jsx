import { useEffect, useState } from 'react';
import client from '../../api/client';
import { LoadingState } from '../../components/common/LoadingState';
import { StatusBadge } from '../../components/common/StatusBadge';
import { SummaryCard } from '../../components/common/SummaryCard';

export function AdminDashboardPage() {
  const [loading, setLoading] = useState(true);
  const [data, setData] = useState({ users: [], stalls: [], reports: [] });

  useEffect(() => {
    Promise.all([client.get('/users'), client.get('/stalls'), client.get('/reports')]).then(([users, stalls, reports]) => {
      setData({
        users: users.data.data ?? [],
        stalls: stalls.data.data ?? [],
        reports: reports.data.data ?? [],
      });
      setLoading(false);
    });
  }, []);

  if (loading) {
    return <LoadingState text="Cargando panel administrador..." />;
  }

  return (
    <div className="d-grid gap-4">
      <div className="row g-4">
        <div className="col-md-4"><SummaryCard icon="bi-person-badge" title="Usuarios" value={data.users.length} subtitle="Administración de accesos" /></div>
        <div className="col-md-4"><SummaryCard icon="bi-shop-window" title="Puestos" value={data.stalls.length} subtitle="Control municipal" color="info" /></div>
        <div className="col-md-4"><SummaryCard icon="bi-megaphone" title="Reportes" value={data.reports.length} subtitle="Seguimiento ciudadano" color="warning" /></div>
      </div>

      <div className="card panel-card">
        <div className="card-body p-4">
          <h4 className="fw-bold mb-3">Puestos y estado sanitario</h4>
          <div className="table-responsive">
            <table className="table align-middle">
              <thead>
                <tr>
                  <th>Puesto</th>
                  <th>Distrito</th>
                  <th>Licencia</th>
                  <th>Estado sanitario</th>
                </tr>
              </thead>
              <tbody>
                {data.stalls.map((stall) => (
                  <tr key={stall.id}>
                    <td>{stall.stall_name}</td>
                    <td>{stall.district}</td>
                    <td><StatusBadge value={stall.license_status} /></td>
                    <td><StatusBadge value={stall.sanitary_status} /></td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div className="card panel-card">
        <div className="card-body p-4">
          <h4 className="fw-bold mb-3">Últimos reportes ciudadanos</h4>
          <div className="table-responsive">
            <table className="table align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                {data.reports.map((report) => (
                  <tr key={report.id}>
                    <td>#{report.id}</td>
                    <td>{report.description}</td>
                    <td><StatusBadge value={report.status} /></td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
}

