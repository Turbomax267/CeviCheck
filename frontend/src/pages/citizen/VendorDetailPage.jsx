import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import client from '../../api/client';
import { LoadingState } from '../../components/common/LoadingState';
import { StatusBadge } from '../../components/common/StatusBadge';

export function VendorDetailPage() {
  const { id } = useParams();
  const [vendor, setVendor] = useState(null);

  useEffect(() => {
    client.get(`/vendors/${id}`).then((response) => {
      setVendor(response.data.data);
    });
  }, [id]);

  if (!vendor) {
    return <LoadingState text="Cargando detalle..." />;
  }

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <h2 className="fw-bold mb-1">{vendor.full_name}</h2>
        <p className="text-muted">DNI {vendor.dni} · {vendor.phone}</p>
        <div className="row g-4 mt-2">
          {vendor.food_stalls?.map((stall) => (
            <div className="col-lg-6" key={stall.id}>
              <div className="border rounded-4 p-4 h-100">
                <div className="d-flex justify-content-between align-items-start gap-3">
                  <div>
                    <h5 className="fw-bold">{stall.stall_name}</h5>
                    <p className="text-muted mb-2">{stall.district} · {stall.address}</p>
                  </div>
                  <div className="d-flex flex-column gap-2 text-end">
                    <StatusBadge value={stall.sanitary_status} />
                    <StatusBadge value={stall.license_status} />
                  </div>
                </div>
                <hr />
                <p className="fw-semibold mb-2">Inspecciones recientes</p>
                <ul className="mb-0">
                  {(stall.inspections ?? []).slice(0, 3).map((inspection) => (
                    <li key={inspection.id}>
                      {inspection.inspection_date}: <StatusBadge value={inspection.sanitary_status} />
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

