import React, { createContext, useContext, useState, useEffect } from 'react';

const AuthContext = createContext();

export const useAuth = () => {
    const context = useContext(AuthContext);
    if (!context) {
        throw new Error('useAuth must be used within an AuthProvider');
    }
    return context;
};

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(null);
    const [loading, setLoading] = useState(true);

    // Initialize auth state from localStorage on mount
    useEffect(() => {
        const storedToken = localStorage.getItem('access_token');
        const storedUser = localStorage.getItem('user_data');

        if (storedToken && storedUser) {
            setToken(storedToken);
            setUser(JSON.parse(storedUser));
        }
        setLoading(false);
    }, []);

    // Login function
    const login = async (email, password) => {
        try {
            setLoading(true);

            // This would be your actual API endpoint
            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email, password }),
            });

            const data = await response.json();

            if (data.success) {
                const { access_token, token_type, ...userData } = data.data;

                // Store token and user data
                localStorage.setItem('access_token', access_token);
                localStorage.setItem('token_type', token_type);
                localStorage.setItem('user_data', JSON.stringify(userData));

                setToken(access_token);
                setUser(userData);

                return { success: true, data: data.data };
            } else {
                return { success: false, message: data.message };
            }
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, message: 'Network error occurred' };
        } finally {
            setLoading(false);
        }
    };

    // Register function
    const register = async (userData) => {
        try {
            setLoading(true);

            // This would be your actual API endpoint
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(userData),
            });

            const data = await response.json();

            if (data.success) {
                const { access_token, token_type, ...userInfo } = data.data;

                // Store token and user data
                localStorage.setItem('access_token', access_token);
                localStorage.setItem('token_type', token_type);
                localStorage.setItem('user_data', JSON.stringify(userInfo));

                setToken(access_token);
                setUser(userInfo);

                return { success: true, data: data.data };
            } else {
                return { success: false, message: data.message };
            }
        } catch (error) {
            console.error('Registration error:', error);
            return { success: false, message: 'Network error occurred' };
        } finally {
            setLoading(false);
        }
    };

    // Logout function
    const logout = () => {
        localStorage.removeItem('access_token');
        localStorage.removeItem('token_type');
        localStorage.removeItem('user_data');
        setToken(null);
        setUser(null);
    };

    // Check if user is authenticated
    const isAuthenticated = () => {
        return token && user;
    };

    // Get authorization header for API requests
    const getAuthHeader = () => {
        const tokenType = localStorage.getItem('token_type') || 'Bearer';
        return token ? { Authorization: `${tokenType} ${token}` } : {};
    };

    const value = {
        user,
        token,
        loading,
        login,
        register,
        logout,
        isAuthenticated,
        getAuthHeader,
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
};