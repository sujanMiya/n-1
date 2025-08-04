import React, { useState } from 'react';
import { AuthProvider, useAuth } from './contexts/AuthContext';
import LoginForm from './components/LoginForm';
import RegisterForm from './components/RegisterForm';
import Dashboard from './components/Dashboard';
import { Loader2 } from 'lucide-react';
import './App.css';

// Main App Content Component
const AppContent = () => {
    const { user, loading } = useAuth();
    const [currentView, setCurrentView] = useState('login'); // 'login' or 'register'

    // Show loading spinner while checking authentication
    if (loading) {
        return (
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center">
                <div className="text-center">
                    <Loader2 className="w-12 h-12 animate-spin text-blue-600 mx-auto mb-4" />
                    <p className="text-gray-600 dark:text-gray-400">Loading...</p>
                </div>
            </div>
        );
    }

    // Show dashboard if user is authenticated
    if (user) {
        return <Dashboard />;
    }

    // Show authentication forms if user is not authenticated
    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">
            <div className="w-full max-w-md">
                {currentView === 'login' ? (
                    <LoginForm onSwitchToRegister={() => setCurrentView('register')} />
                ) : (
                    <RegisterForm onSwitchToLogin={() => setCurrentView('login')} />
                )}
            </div>
        </div>
    );
};

// Main App Component
function App() {
    return (
        <AuthProvider>
            <div className="App">
                <AppContent />
            </div>
        </AuthProvider>
    );
}

export default App;
