import { Link } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

export function Navbar() {
  const { user, logout } = useAuth();

  return (
    <nav className="navbar navbar-expand-lg bg-white border-bottom sticky-top">
      <div className="container-fluid px-4">
        <Link className="navbar-brand fw-bold text-primary" to="/">
          <i className="bi bi-shield-check me-2" />
          CeviCheck
        </Link>
        <div className="ms-auto d-flex align-items-center gap-3">
          {user ? (
            <>
              <div className="text-end">
                <div className="fw-semibold">{user.name}</div>
                <small className="text-muted text-capitalize">{user.role}</small>
              </div>
              <button className="btn btn-outline-danger btn-sm" onClick={logout}>
                Salir
              </button>
            </>
          ) : (
            <>
              <Link className="btn btn-outline-primary btn-sm" to="/login">
                Iniciar sesión
              </Link>
              <Link className="btn btn-primary btn-sm" to="/register">
                Registro
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
}

