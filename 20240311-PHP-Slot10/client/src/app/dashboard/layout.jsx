"use client";
import NavBarReponsive from "@/components/NavBarReponsive";
import Sidebar from "@/components/Sidebar";
import { AuthContext } from "@/components/User/AuthProvider";
import { useContext } from "react";

export const metadata = {
  title: "Dashboard",
  description: "Dashboard",
};

export default function DashBoardLayout({ children }) {
  const { user } = useContext(AuthContext);
  const hasMultipleRoles = user && user.roles && user.roles.length > 0;
  return (
    <>
      {hasMultipleRoles ? (
        <div>
          <Sidebar />
          <div className="p-4 sm:ml-64">
            <div className="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
              {children}
            </div>
          </div>
        </div>
      ) : (
        <p className="text-xl text-red-500">
          Please log in with your administrator account to access the control panel
        </p>
      )}
    </>
  );
}
