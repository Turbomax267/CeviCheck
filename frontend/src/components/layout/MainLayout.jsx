import { Outlet } from 'react-router-dom';
import { Navbar } from './Navbar';
import { Sidebar } from './Sidebar';

export function MainLayout() {
  return (
    <div className="app-shell">
      <Navbar />
      <div className="d-flex flex-column flex-lg-row">
        <Sidebar />
        <main className="content-area flex-grow-1 p-4">
          <Outlet />
        </main>
      </div>
    </div>
  );
}

