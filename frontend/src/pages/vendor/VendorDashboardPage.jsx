import { useEffect, useMemo, useState } from 'react';
import client from '../../api/client';
import { SummaryCard } from '../../components/common/SummaryCard';
import { StatusBadge } from '../../components/common/StatusBadge';
import { useAuth } from '../../context/AuthContext';

export function VendorDashboardPage() {
  const { user } = useAuth();
  const [stalls, setStalls] = useState([]);

  useEffect(() => {
    client.get('/stalls').then((response) => {
      setStalls(response.data.data ?? []);
    });
  }, []);

  const myStalls = useMemo(
    () => stalls.filter((stall) => stall.vendor?.user_id === user?.id || stall.vendor_id === user?.vendor?.id),
    [stalls, user],
  );

  return (
    <div className="d-grid gap-4">
      <div className="row g-4">
        <div className="col-md-4"><SummaryCard icon="bi-shop" title="Mis puestos" value={myStalls.length} subtitle="Puestos bajo tu gestión" /></div>
        <div className="col-md-4"><SummaryCard icon="bi-shield-check" title="Aptos" value={myStalls.filter((item) => item.sanitary_status === 'apto').length} subtitle="Listos para operar" color="success" /></div>
        <div className="col-md-4"><SummaryCard icon="bi-file-earmark-check" title="Licencias vigentes" value={myStalls.filter((item) => item.license_status === 'vigente').length} subtitle="Documentación al día" color="info" /></div>
      </div>

      <div className="card panel-card">
        <div className="card-body p-4">
          <h4 className="fw-bold">Resumen de puestos</h4>
          <div className="row g-4 mt-1">
            {myStalls.map((stall) => (
              <div className="col-lg-6" key={stall.id}>
                <div className="border rounded-4 p-4 h-100">
                  <h5 className="fw-bold">{stall.stall_name}</h5>
                  <p className="text-muted">{stall.district} · {stall.address}</p>
                  <div className="d-flex gap-2 flex-wrap">
                    <StatusBadge value={stall.license_status} />
                    <StatusBadge value={stall.sanitary_status} />
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
}

