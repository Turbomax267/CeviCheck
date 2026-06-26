import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { MainLayout } from '../components/layout/MainLayout';
import { HomePage } from '../pages/HomePage';
import { NotFoundPage } from '../pages/NotFoundPage';
import { AdminDashboardPage } from '../pages/admin/AdminDashboardPage';
import { InspectionFormPage } from '../pages/admin/InspectionFormPage';
import { LicenseFormPage } from '../pages/admin/LicenseFormPage';
import { LoginPage } from '../pages/auth/LoginPage';
import { RegisterPage } from '../pages/auth/RegisterPage';
import { ReportFormPage } from '../pages/citizen/ReportFormPage';
import { VendorDetailPage } from '../pages/citizen/VendorDetailPage';
import { VendorsPage } from '../pages/citizen/VendorsPage';
import { StallFormPage } from '../pages/vendor/StallFormPage';
import { VendorDashboardPage } from '../pages/vendor/VendorDashboardPage';
import { ProtectedRoute } from './ProtectedRoute';

export function AppRouter() {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<MainLayout />}>
          <Route index element={<HomePage />} />
          <Route path="login" element={<LoginPage />} />
          <Route path="register" element={<RegisterPage />} />
          <Route path="vendors" element={<VendorsPage />} />
          <Route path="vendors/:id" element={<VendorDetailPage />} />

          <Route element={<ProtectedRoute roles={['citizen', 'vendor', 'admin']} />}>
            <Route path="reports/new" element={<ReportFormPage />} />
          </Route>

          <Route element={<ProtectedRoute roles={['vendor', 'admin']} />}>
            <Route path="stalls/new" element={<StallFormPage />} />
          </Route>

          <Route element={<ProtectedRoute roles={['vendor']} />}>
            <Route path="vendor" element={<VendorDashboardPage />} />
          </Route>

          <Route element={<ProtectedRoute roles={['admin']} />}>
            <Route path="admin" element={<AdminDashboardPage />} />
            <Route path="licenses/new" element={<LicenseFormPage />} />
            <Route path="inspections/new" element={<InspectionFormPage />} />
          </Route>

          <Route path="*" element={<NotFoundPage />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

