import { NavLink } from 'react-router-dom';
import { useAuth } from '../../context/AuthContext';

const items = [
  { to: '/', icon: 'bi-house-door', label: 'Inicio', roles: ['guest', 'admin', 'vendor', 'citizen'] },
  { to: '/vendors', icon: 'bi-people', label: 'Vendedores', roles: ['guest', 'admin', 'vendor', 'citizen'] },
  { to: '/reports/new', icon: 'bi-megaphone', label: 'Reportar', roles: ['admin', 'vendor', 'citizen'] },
  { to: '/admin', icon: 'bi-speedometer2', label: 'Panel Admin', roles: ['admin'] },
  { to: '/vendor', icon: 'bi-shop', label: 'Panel Vendedor', roles: ['vendor'] },
  { to: '/stalls/new', icon: 'bi-plus-square', label: 'Nuevo puesto', roles: ['vendor', 'admin'] },
  { to: '/licenses/new', icon: 'bi-card-checklist', label: 'Nueva licencia', roles: ['admin'] },
  { to: '/inspections/new', icon: 'bi-clipboard2-pulse', label: 'Nueva inspección', roles: ['admin'] },
];

export function Sidebar() {
  const { user } = useAuth();
  const role = user?.role ?? 'guest';

  return (
    <aside className="sidebar text-white p-4">
      <div className="mb-4">
        <h4 className="fw-bold">CeviCheck</h4>
        <p className="small text-white-50 mb-0">Control sanitario de ceviche ambulante</p>
      </div>
      <nav className="nav flex-column gap-2">
        {items
          .filter((item) => item.roles.includes(role))
          .map((item) => (
            <NavLink
              key={item.to}
              to={item.to}
              className={({ isActive }) => `nav-link px-3 py-3 ${isActive ? 'active' : ''}`}
            >
              <i className={`bi ${item.icon} me-2`} />
              {item.label}
            </NavLink>
          ))}
      </nav>
    </aside>
  );
}

