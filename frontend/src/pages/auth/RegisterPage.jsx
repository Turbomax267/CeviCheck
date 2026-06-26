import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export function RegisterPage() {
  const navigate = useNavigate();
  const { register } = useAuth();
  const [form, setForm] = useState({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'citizen',
    dni: '',
    phone: '',
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleSubmit = async (event) => {
    event.preventDefault();
    setLoading(true);
    setError('');

    try {
      await register(form);
      navigate(form.role === 'vendor' ? '/vendor' : '/');
    } catch (err) {
      setError(err.response?.data?.message || 'No se pudo completar el registro.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="card hero-card">
      <div className="card-body p-4">
        <h2 className="fw-bold">Registro en CeviCheck</h2>
        <p className="text-muted">Ciudadanos y vendedores pueden crear su cuenta.</p>
        {error && <div className="alert alert-danger">{error}</div>}
        <form className="row g-3" onSubmit={handleSubmit}>
          <div className="col-md-6">
            <label className="form-label">Nombre</label>
            <input className="form-control" value={form.name} onChange={(e) => setForm({ ...form, name: e.target.value })} />
          </div>
          <div className="col-md-6">
            <label className="form-label">Correo</label>
            <input className="form-control" type="email" value={form.email} onChange={(e) => setForm({ ...form, email: e.target.value })} />
          </div>
          <div className="col-md-4">
            <label className="form-label">Rol</label>
            <select className="form-select" value={form.role} onChange={(e) => setForm({ ...form, role: e.target.value })}>
              <option value="citizen">Ciudadano</option>
              <option value="vendor">Vendedor</option>
            </select>
          </div>
          <div className="col-md-4">
            <label className="form-label">Contraseña</label>
            <input className="form-control" type="password" value={form.password} onChange={(e) => setForm({ ...form, password: e.target.value })} />
          </div>
          <div className="col-md-4">
            <label className="form-label">Confirmar contraseña</label>
            <input className="form-control" type="password" value={form.password_confirmation} onChange={(e) => setForm({ ...form, password_confirmation: e.target.value })} />
          </div>
          {form.role === 'vendor' && (
            <>
              <div className="col-md-6">
                <label className="form-label">DNI</label>
                <input className="form-control" value={form.dni} onChange={(e) => setForm({ ...form, dni: e.target.value })} />
              </div>
              <div className="col-md-6">
                <label className="form-label">Teléfono</label>
                <input className="form-control" value={form.phone} onChange={(e) => setForm({ ...form, phone: e.target.value })} />
              </div>
            </>
          )}
          <div className="col-12">
            <button className="btn btn-primary" disabled={loading}>
              {loading ? 'Registrando...' : 'Crear cuenta'}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

