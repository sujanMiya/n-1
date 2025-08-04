import React from 'react';
import { LogOut, User, Mail, Calendar, Shield, Settings, Bell } from 'lucide-react';
import { Button } from '../components/ui/button';
import { useAuth } from '../contexts/AuthContext';

const Dashboard = () => {
    const { user, logout } = useAuth();

    const handleLogout = () => {
        logout();
    };

    const formatDate = (dateString) => {
        if (!dateString) return 'Not available';
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    };

    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
            {/* Header */}
            <header className="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center h-16">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <Shield className="w-5 h-5 text-white" />
                                </div>
                            </div>
                            <div className="ml-3">
                                <h1 className="text-xl font-semibold text-gray-900 dark:text-white">
                                    Dashboard
                                </h1>
                            </div>
                        </div>
                        <div className="flex items-center space-x-4">
                            <button className="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <Bell className="w-5 h-5" />
                            </button>
                            <button className="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                                <Settings className="w-5 h-5" />
                            </button>
                            <Button
                                onClick={handleLogout}
                                variant="outline"
                                size="sm"
                                className="text-red-600 border-red-600 hover:bg-red-50 dark:text-red-400 dark:border-red-400 dark:hover:bg-red-900/20"
                            >
                                <LogOut className="w-4 h-4 mr-2" />
                                Logout
                            </Button>
                        </div>
                    </div>
                </div>
            </header>

            {/* Main Content */}
            <main className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {/* Welcome Section */}
                <div className="mb-8">
                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <User className="w-8 h-8 text-white" />
                            </div>
                            <div className="ml-6">
                                <h2 className="text-3xl font-bold text-gray-900 dark:text-white">
                                    Welcome back, {user?.name}!
                                </h2>
                                <p className="text-gray-600 dark:text-gray-400 mt-1">
                                    Here's your account overview
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                                <User className="w-6 h-6 text-blue-600 dark:text-blue-400" />
                            </div>
                            <div className="ml-4">
                                <h3 className="text-sm font-medium text-gray-600 dark:text-gray-400">Account Status</h3>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white">Active</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                                <Shield className="w-6 h-6 text-green-600 dark:text-green-400" />
                            </div>
                            <div className="ml-4">
                                <h3 className="text-sm font-medium text-gray-600 dark:text-gray-400">Role</h3>
                                <p className="text-2xl font-bold text-gray-900 dark:text-white capitalize">
                                    {user?.role || 'User'}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div className="flex items-center">
                            <div className="w-12 h-12 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                                <Calendar className="w-6 h-6 text-purple-600 dark:text-purple-400" />
                            </div>
                            <div className="ml-4">
                                <h3 className="text-sm font-medium text-gray-600 dark:text-gray-400">Member Since</h3>
                                <p className="text-lg font-bold text-gray-900 dark:text-white">
                                    {formatDate(user?.created_at)}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Profile Information */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-6">
                            Profile Information
                        </h3>
                        <div className="space-y-4">
                            <div className="flex items-center">
                                <User className="w-5 h-5 text-gray-400 mr-3" />
                                <div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Full Name</p>
                                    <p className="font-medium text-gray-900 dark:text-white">{user?.name}</p>
                                </div>
                            </div>
                            <div className="flex items-center">
                                <Mail className="w-5 h-5 text-gray-400 mr-3" />
                                <div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Email Address</p>
                                    <p className="font-medium text-gray-900 dark:text-white">{user?.email}</p>
                                </div>
                            </div>
                            <div className="flex items-center">
                                <Shield className="w-5 h-5 text-gray-400 mr-3" />
                                <div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">User ID</p>
                                    <p className="font-medium text-gray-900 dark:text-white">#{user?.id}</p>
                                </div>
                            </div>
                            <div className="flex items-center">
                                <Calendar className="w-5 h-5 text-gray-400 mr-3" />
                                <div>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">Last Updated</p>
                                    <p className="font-medium text-gray-900 dark:text-white">
                                        {formatDate(user?.updated_at)}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
                        <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-6">
                            Account Security
                        </h3>
                        <div className="space-y-4">
                            <div className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div className="flex items-center">
                                    <Mail className="w-5 h-5 text-gray-400 mr-3" />
                                    <div>
                                        <p className="font-medium text-gray-900 dark:text-white">Email Verification</p>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            {user?.email_verified_at ? 'Verified' : 'Not verified'}
                                        </p>
                                    </div>
                                </div>
                                <div className={`w-3 h-3 rounded-full ${
                                    user?.email_verified_at ? 'bg-green-500' : 'bg-yellow-500'
                                }`}></div>
                            </div>

                            <div className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div className="flex items-center">
                                    <Shield className="w-5 h-5 text-gray-400 mr-3" />
                                    <div>
                                        <p className="font-medium text-gray-900 dark:text-white">Account Status</p>
                                        <p className="text-sm text-gray-600 dark:text-gray-400">
                                            {user?.deleted_at ? 'Deactivated' : 'Active'}
                                        </p>
                                    </div>
                                </div>
                                <div className={`w-3 h-3 rounded-full ${
                                    user?.deleted_at ? 'bg-red-500' : 'bg-green-500'
                                }`}></div>
                            </div>

                            <Button className="w-full mt-4" variant="outline">
                                <Settings className="w-4 h-4 mr-2" />
                                Manage Security Settings
                            </Button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
};

export default Dashboard;
