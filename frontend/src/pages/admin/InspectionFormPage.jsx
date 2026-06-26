import { useEffect, useState } from 'react';
import client from '../../api/client';
import { useAuth } from '../../context/AuthContext';

export function InspectionFormPage() {
  const { user } = useAuth();
  const [stalls, setStalls] = useState([]);
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');
  const [form, setForm] = useState({
    stall_id: '',
    inspection_date: '',
    observations: '',
    sanitary_status: 'pendiente',
    inspected_by: user?.id ?? '',
  });

  useEffect(() => {
    client.get('/stalls').then((response) => setStalls(response.data.data ?? []));
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();
    setMessage('');
    setError('');
    try {
      await client.post('/inspections', { ...form, inspected_by: user?.id });
      setMessage('Inspección registrada correctamente.');
    } catch (err) {
      setError(err.response?.data?.message || 'No se pudo registrar la inspección.');
    }
  };

  return (
    <div className="card panel-card">
      <div className="card-body p-4">
        <h2 className="fw-bold">Formulario de inspecciones</h2>
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
            <label className="form-label">Fecha</label>
            <input className="form-control" type="date" value={form.inspection_date} onChange={(e) => setForm({ ...form, inspection_date: e.target.value })} />
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
            <label className="form-label">Observaciones</label>
            <textarea className="form-control" rows="4" value={form.observations} onChange={(e) => setForm({ ...form, observations: e.target.value })} />
          </div>
          <div className="col-12">
            <button className="btn btn-primary">Guardar inspección</button>
          </div>
        </form>
      </div>
    </div>
  );
}

