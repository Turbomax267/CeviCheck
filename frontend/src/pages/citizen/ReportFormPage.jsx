import { useEffect, useState } from 'react';
import client from '../../api/client';

export function ReportFormPage() {
  const [stalls, setStalls] = useState([]);
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');
  const [form, setForm] = useState({ stall_id: '', description: '' });

  useEffect(() => {
    client.get('/stalls').then((response) => {
      setStalls(response.data.data ?? []);
    });
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setError('');
    setMessage('');
    try {
      await client.post('/reports', form);
      setMessage('Reporte ciudadano enviado correctamente.');
      setForm({ stall_id: '', description: '' });
    } catch (err) {
      setError(err.response?.data?.message || 'No se pudo registrar el reporte.');
    }
  };

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <h2 className="fw-bold">Formulario de reporte ciudadano</h2>
        <p className="text-muted">Ayúdanos a monitorear la inocuidad alimentaria en la vía pública.</p>
        {message && <div className="alert alert-success">{message}</div>}
        {error && <div className="alert alert-danger">{error}</div>}
        <form className="row g-3" onSubmit={handleSubmit}>
          <div className="col-12">
            <label className="form-label">Puesto</label>
            <select className="form-select" value={form.stall_id} onChange={(e) => setForm({ ...form, stall_id: e.target.value })}>
              <option value="">Selecciona un puesto</option>
              {stalls.map((stall) => (
                <option key={stall.id} value={stall.id}>
                  {stall.stall_name} · {stall.district}
                </option>
              ))}
            </select>
          </div>
          <div className="col-12">
            <label className="form-label">Descripción</label>
            <textarea className="form-control" rows="5" value={form.description} onChange={(e) => setForm({ ...form, description: e.target.value })} />
          </div>
          <div className="col-12">
            <button className="btn btn-primary">Enviar reporte</button>
          </div>
        </form>
      </div>
    </div>
  );
}

