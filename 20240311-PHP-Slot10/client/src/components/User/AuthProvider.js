"use client"
const axios = require('axios');
import React, { createContext, useState, useEffect } from "react";
import { useRouter } from 'next/navigation'
import Cookies from 'js-cookie';
import { toast } from "react-toastify";

export const AuthContext = createContext();

const AuthProvider = ({ children }) => {
    const router = useRouter()
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const [username, setUsername] = useState("");
    const [userId, setUserId] = useState("");
    const [user, setUser] = useState("");
    const [email, setEmail] = useState("");
    const [errorMessage, setErrorMessage] = useState("");
    useEffect(() => {
        setErrorMessage("")
        const token = Cookies.get("access_token");
        if (token) {
            fetchUserData(token);
        }
    }, [isLoggedIn]);

    const handleLogin = async (email, password) => {
        try {
            let data = new FormData();
            data.append('email', email);
            data.append('password', password);

            const response = await axios.post(process.env.DOMAIN + "/auth/login", data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });

            const token = response.data.access_token;
            console.log(token);
            Cookies.set("access_token", token, {
                expires: 1,
                secure: true,
                sameSite: "strict",
            });
            fetchUserData(token);
            toast.success("Đăng nhập thành công");
            router.push('/dashboard/users')
        } catch (error) {
            console.error("Đã xảy ra lỗi:", error);
            setErrorMessage("Đã xảy ra lỗi trong quá trình đăng nhập.");
            toast.error(error.message);
            return false;
        }
    };

    const handleRegister = async (name, email, password, password_confirmation) => {
        try {
            const response = await fetch(process.env.DOMAIN + "/auth/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ name, email, password, password_confirmation }),
            });

            if (response.ok) {
                toast.success("Đăng ký thành công, đang đăng nhập");
                setErrorMessage("Đăng ký thành công, đang đăng nhập")

                const success = await handleLogin(name, password);
                router.push('/dashboard/users')
                return success;
            } else {
                const data = await response.json();
                setErrorMessage(data.message || "Đăng ký không thành công. Vui lòng kiểm tra thông tin đăng ký.");
                return false;
            }
        } catch (error) {
            console.error("Đã xảy ra lỗi:", error);
            setErrorMessage("Đã xảy ra lỗi trong quá trình đăng ký.");
            return false;
        }
    };

    const handleLogout = () => {
        Cookies.remove("access_token");
        setIsLoggedIn(false);
        setUsername("");
    };

    const fetchUserData = async (token) => {
        try {
            const response = await axios.get(process.env.DOMAIN + "/auth/me", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            const data = response.data.user;
            setIsLoggedIn(true);
            setUserId(data.id);
            setUsername(data.name);
            setEmail(data.email);
            setUser(data);

        } catch (error) {
            console.error("Error fetching user data:", error);
        }
    };


    return (
        <AuthContext.Provider
            value={{
                user,
                userId,
                isLoggedIn,
                username,
                email,
                errorMessage,
                handleLogin,
                handleRegister,
                handleLogout,
                fetchUserData,
            }}
        >
            {children}
        </AuthContext.Provider>
    );
};

export default AuthProvider;
