import { Navigate, Outlet } from 'react-router-dom';
import { LoadingState } from '../components/common/LoadingState';
import { useAuth } from '../context/AuthContext';

export function ProtectedRoute({ roles }) {
  const { user, loading, isAuthenticated } = useAuth();

  if (loading) {
    return <LoadingState text="Validando sesión..." />;
  }

  if (!isAuthenticated) {
    return <Navigate to="/login" replace />;
  }

  if (roles && !roles.includes(user.role)) {
    return <Navigate to="/" replace />;
  }

  return <Outlet />;
}

