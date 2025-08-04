// API base configuration
const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8000/api';

// Helper function to get auth headers
const getAuthHeaders = () => {
    const token = localStorage.getItem('access_token');
    const tokenType = localStorage.getItem('token_type') || 'Bearer';

    return {
        'Content-Type': 'application/json',
        ...(token && { Authorization: `${tokenType} ${token}` }),
    };
};

// Generic API request function
const apiRequest = async (endpoint, options = {}) => {
    const url = `${API_BASE_URL}${endpoint}`;
    const config = {
        headers: getAuthHeaders(),
        ...options,
    };

    try {
        const response = await fetch(url, config);
        const data = await response.json();

        // Handle token expiration
        if (response.status === 401) {
            localStorage.removeItem('access_token');
            localStorage.removeItem('token_type');
            localStorage.removeItem('user_data');
            window.location.href = '/login';
            return { success: false, message: 'Session expired. Please login again.' };
        }

        return data;
    } catch (error) {
        console.error('API request error:', error);
        return {
            success: false,
            message: 'Network error. Please check your connection.',
        };
    }
};

// Authentication API functions
export const authAPI = {
    // Login user
    login: async (email, password) => {
        return apiRequest('/login', {
            method: 'POST',
            body: JSON.stringify({ email, password }),
        });
    },

    // Register user
    register: async (userData) => {
        return apiRequest('/register', {
            method: 'POST',
            body: JSON.stringify(userData),
        });
    },

    // Logout user
    logout: async () => {
        return apiRequest('/logout', {
            method: 'POST',
        });
    },

    // Get user profile
    getProfile: async () => {
        return apiRequest('/profile');
    },

    // Update user profile
    updateProfile: async (userData) => {
        return apiRequest('/profile', {
            method: 'PUT',
            body: JSON.stringify(userData),
        });
    },

    // Change password
    changePassword: async (currentPassword, newPassword) => {
        return apiRequest('/change-password', {
            method: 'POST',
            body: JSON.stringify({
                current_password: currentPassword,
                new_password: newPassword,
            }),
        });
    },

    // Verify email
    verifyEmail: async (token) => {
        return apiRequest('/verify-email', {
            method: 'POST',
            body: JSON.stringify({ token }),
        });
    },

    // Request password reset
    requestPasswordReset: async (email) => {
        return apiRequest('/forgot-password', {
            method: 'POST',
            body: JSON.stringify({ email }),
        });
    },

    // Reset password
    resetPassword: async (token, password) => {
        return apiRequest('/reset-password', {
            method: 'POST',
            body: JSON.stringify({ token, password }),
        });
    },
};

// Generic data API functions
export const dataAPI = {
    // Generic GET request
    get: async (endpoint) => {
        return apiRequest(endpoint);
    },

    // Generic POST request
    post: async (endpoint, data) => {
        return apiRequest(endpoint, {
            method: 'POST',
            body: JSON.stringify(data),
        });
    },

    // Generic PUT request
    put: async (endpoint, data) => {
        return apiRequest(endpoint, {
            method: 'PUT',
            body: JSON.stringify(data),
        });
    },

    // Generic DELETE request
    delete: async (endpoint) => {
        return apiRequest(endpoint, {
            method: 'DELETE',
        });
    },
};

export default apiRequest;
