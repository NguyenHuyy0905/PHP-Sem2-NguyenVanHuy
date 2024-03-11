"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import Link from "next/link";

const UserTable = () => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get("/auth/index");
        console.log(response.data);

        setUsers(response.data);
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    };

    fetchData();
  }, []);

  return (
    <div className="container mx-auto mt-8">
      <h1 className="text-2xl font-bold mb-4">User List</h1>
      <table className="min-w-full table-auto">
        <thead>
          <tr>
            <th className="border border-gray-300 px-4 py-2">ID</th>
            <th className="border border-gray-300 px-4 py-2">Name</th>
            <th className="border border-gray-300 px-4 py-2">Email</th>
            <th className="border border-gray-300 px-4 py-2">created_at</th>
            <th className="border border-gray-300 px-4 py-2">Roles</th>
            <th className="border border-gray-300 px-4 py-2">Permissions</th>
            <th className="border border-gray-300 px-4 py-2">Categories</th>
            <th className="border border-gray-300 px-4 py-2">Edit</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.user.user.id}>
              <td className="border border-gray-300 px-4 py-2">{user.user.user.id}</td>
              <td className="border border-gray-300 px-4 py-2">{user.user.user.name}</td>
              <td className="border border-gray-300 px-4 py-2">{user.user.user.email}</td>
              <td className="border border-gray-300 px-4 py-2">{user.user.user.created_at}</td>
              <td className="border border-gray-300 px-4 py-2">
                {user.user.roles.map((role, index) => (
                  <span key={index} className="text-white text-xs bg-blue-500 rounded-md px-1  py-1 inline-block m-1">
                    {role}
                  </span>
                ))}
              </td>

              <td className="border border-gray-300 px-4 py-2">
                {user.user.permissions.map((permission, index) => (
                  <span key={index} className="text-white text-xs bg-blue-500 rounded-md px-1  py-1 inline-block m-1">
                    {permission}
                  </span>
                ))}
              </td>

              <td className="border border-gray-300 px-4 py-2">
                {user.user.category.map((cate, index) => (
                  <span key={index} className="text-white text-xs bg-blue-500 rounded-md px-1  py-1 inline-block m-1">
                    {cate.name}
                  </span>
                ))}
              </td>

              <td className="border border-gray-300 px-4 py-2">
                <Link href={`/dashboard/users/edit-user-role/${user.user.user.id}`}>
                  <button className="flex p-2.5 bg-yellow-500 rounded-xl hover:rounded-3xl hover:bg-yellow-600 transition-all duration-300 text-white">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      className="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      strokeWidth={2}
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                      />
                    </svg>
                    Edit
                  </button>
                </Link>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UserTable;
