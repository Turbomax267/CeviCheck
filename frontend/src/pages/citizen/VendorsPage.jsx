import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import client from '../../api/client';
import { LoadingState } from '../../components/common/LoadingState';

export function VendorsPage() {
  const [vendors, setVendors] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    client.get('/vendors').then((response) => {
      setVendors(response.data.data ?? []);
      setLoading(false);
    });
  }, []);

  if (loading) {
    return <LoadingState text="Cargando vendedores..." />;
  }

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <div className="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h2 className="fw-bold mb-1">Vendedores registrados</h2>
            <p className="text-muted mb-0">Consulta puestos, datos de contacto y situación sanitaria.</p>
          </div>
        </div>
        <div className="row g-4">
          {vendors.map((vendor) => (
            <div className="col-md-6 col-xl-4" key={vendor.id}>
              <div className="card h-100 border-0 shadow-sm">
                <div className="card-body">
                  <h5 className="fw-bold">{vendor.full_name}</h5>
                  <p className="text-muted mb-1">DNI: {vendor.dni}</p>
                  <p className="text-muted">Teléfono: {vendor.phone}</p>
                  <p className="small mb-3">Puestos registrados: {vendor.food_stalls?.length ?? 0}</p>
                  <Link className="btn btn-outline-primary btn-sm" to={`/vendors/${vendor.id}`}>
                    Ver detalle
                  </Link>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

