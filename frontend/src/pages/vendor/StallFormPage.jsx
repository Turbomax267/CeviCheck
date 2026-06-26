import { useEffect, useState } from 'react';
import client from '../../api/client';
import { useAuth } from '../../context/AuthContext';

export function StallFormPage() {
  const { user } = useAuth();
  const [vendors, setVendors] = useState([]);
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');
  const [form, setForm] = useState({
    vendor_id: user?.vendor?.id ?? '',
    stall_name: '',
    district: '',
    address: '',
    license_status: 'sin_licencia',
    sanitary_status: 'pendiente',
  });

  useEffect(() => {
    if (user?.role === 'admin') {
      client.get('/vendors').then((response) => setVendors(response.data.data ?? []));
    }
  }, [user]);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setMessage('');
    setError('');
    try {
      const endpoint = user?.role === 'admin' ? '/admin/stalls' : '/vendor/stalls';
      await client.post(endpoint, form);
      setMessage('Puesto registrado correctamente.');
    } catch (err) {
      setError(err.response?.data?.message || 'No se pudo registrar el puesto.');
    }
  };

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <h2 className="fw-bold">Formulario de puestos</h2>
        {message && <div className="alert alert-success">{message}</div>}
        {error && <div className="alert alert-danger">{error}</div>}
        <form className="row g-3" onSubmit={handleSubmit}>
          {user?.role === 'admin' && (
            <div className="col-md-6">
              <label className="form-label">Vendedor</label>
              <select className="form-select" value={form.vendor_id} onChange={(e) => setForm({ ...form, vendor_id: e.target.value })}>
                <option value="">Selecciona un vendedor</option>
                {vendors.map((vendor) => (
                  <option key={vendor.id} value={vendor.id}>{vendor.full_name}</option>
                ))}
              </select>
            </div>
          )}
          <div className="col-md-6">
            <label className="form-label">Nombre del puesto</label>
            <input className="form-control" value={form.stall_name} onChange={(e) => setForm({ ...form, stall_name: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Distrito</label>
            <input className="form-control" value={form.district} onChange={(e) => setForm({ ...form, district: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Dirección</label>
            <input className="form-control" value={form.address} onChange={(e) => setForm({ ...form, address: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Licencia</label>
            <select className="form-select" value={form.license_status} onChange={(e) => setForm({ ...form, license_status: e.target.value })}>
              <option value="vigente">Vigente</option>
              <option value="vencida">Vencida</option>
              <option value="suspendida">Suspendida</option>
              <option value="sin_licencia">Sin licencia</option>
            </select>
          </div>
          <div className="col-md-6">
            <label className="form-label">Estado sanitario</label>
            <select className="form-select" value={form.sanitary_status} onChange={(e) => setForm({ ...form, sanitary_status: e.target.value })}>
              <option value="apto">Apto</option>
              <option value="pendiente">Pendiente</option>
              <option value="no_apto">No apto</option>
            </select>
          </div>
          <div className="col-12">
            <button className="btn btn-primary">Guardar puesto</button>
          </div>
        </form>
      </div>
    </div>
  );
}

