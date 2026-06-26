import { useEffect, useState } from 'react';
import client from '../../api/client';

export function LicenseFormPage() {
  const [stalls, setStalls] = useState([]);
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');
  const [form, setForm] = useState({
    stall_id: '',
    license_number: '',
    issue_date: '',
    expiration_date: '',
    status: 'vigente',
  });

  useEffect(() => {
    client.get('/stalls').then((response) => setStalls(response.data.data ?? []));
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setMessage('');
    setError('');
    try {
      await client.post('/licenses', form);
      setMessage('Licencia registrada correctamente.');
    } catch (err) {
      setError(err.response?.data?.message || 'No se pudo registrar la licencia.');
    }
  };

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <h2 className="fw-bold">Formulario de licencias</h2>
        {message && <div className="alert alert-success">{message}</div>}
        {error && <div className="alert alert-danger">{error}</div>}
        <form className="row g-3" onSubmit={handleSubmit}>
          <div className="col-md-6">
            <label className="form-label">Puesto</label>
            <select className="form-select" value={form.stall_id} onChange={(e) => setForm({ ...form, stall_id: e.target.value })}>
              <option value="">Selecciona un puesto</option>
              {stalls.map((stall) => <option key={stall.id} value={stall.id}>{stall.stall_name}</option>)}
            </select>
          </div>
          <div className="col-md-6">
            <label className="form-label">Número</label>
            <input className="form-control" value={form.license_number} onChange={(e) => setForm({ ...form, license_number: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Emisión</label>
            <input className="form-control" type="date" value={form.issue_date} onChange={(e) => setForm({ ...form, issue_date: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Vencimiento</label>
            <input className="form-control" type="date" value={form.expiration_date} onChange={(e) => setForm({ ...form, expiration_date: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Estado</label>
            <select className="form-select" value={form.status} onChange={(e) => setForm({ ...form, status: e.target.value })}>
              <option value="vigente">Vigente</option>
              <option value="vencida">Vencida</option>
              <option value="suspendida">Suspendida</option>
            </select>
          </div>
          <div className="col-12">
            <button className="btn btn-primary">Guardar licencia</button>
          </div>
        </form>
      </div>
    </div>
  );
}

