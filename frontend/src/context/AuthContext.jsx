import { createContext, useContext, useEffect, useMemo, useState } from 'react';
import client from '../api/client';

const AuthContext = createContext(null);

export function AuthProvider({ children }) {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);

  const token = localStorage.getItem('cevicheck_token');

  useEffect(() => {
    const bootstrap = async () => {
      if (!token) {
        setLoading(false);
        return;
      }

      try {
        const response = await client.get('/auth/me');
        setUser(response.data.user.data ?? response.data.user);
      } catch (error) {
        localStorage.removeItem('cevicheck_token');
        setUser(null);
      } finally {
        setLoading(false);
      }
    };

    bootstrap();
  }, [token]);

  const login = async (payload) => {
    const response = await client.post('/auth/login', payload);
    const nextToken = response.data.token;
    const nextUser = response.data.user.data ?? response.data.user;
    localStorage.setItem('cevicheck_token', nextToken);
    setUser(nextUser);
    return nextUser;
  };

  const register = async (payload) => {
    const response = await client.post('/auth/register', payload);
    const nextToken = response.data.token;
    const nextUser = response.data.user.data ?? response.data.user;
    localStorage.setItem('cevicheck_token', nextToken);
    setUser(nextUser);
    return nextUser;
  };

  const logout = async () => {
    try {
      await client.post('/auth/logout');
    } catch (error) {
    } finally {
      localStorage.removeItem('cevicheck_token');
      setUser(null);
    }
  };

  const value = useMemo(
    () => ({
      user,
      loading,
      isAuthenticated: Boolean(user),
      login,
      logout,
      register,
    }),
    [user, loading],
  );

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

export function useAuth() {
  return useContext(AuthContext);
}
