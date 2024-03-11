"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import { toast } from "react-toastify";

const EditUserRoleForm = ({ params }) => {
  const [roles, setRoles] = useState([]);
  const [selectedRoles, setSelectedRoles] = useState([]);

  useEffect(() => {
    const fetchRoles = async () => {
      try {
        const response = await axios.get("/roles");
        setRoles(response.data.data);
      } catch (error) {
        console.log(error);
        toast.error("Error fetching roles");
      }
    };

    fetchRoles();
  }, []);

  const handleUserIdChange = (e) => {
    setUserId(e.target.value);
  };

  const handleRoleChange = (e) => {
    const role = e.target.value;
    const isChecked = e.target.checked;

    if (isChecked) {
      setSelectedRoles([...selectedRoles, role]);
    } else {
      setSelectedRoles(selectedRoles.filter((r) => r !== role));
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const data = {
      user_id: params.id,
      role_name: selectedRoles,
    };

    try {
      const response = await axios.post("/auth/edit-role", data);
      console.log("User role updated successfully:", response.data);
      toast.success("User role updated successfully");
    } catch (error) {
      console.error("Failed to update user role:", error);
      toast.error("Failed to update user role:", error);
    }
  };

  return (
    <div className="max-w-md mx-auto">
      <h2 className="text-2xl font-bold mb-4">Edit User Role</h2>
      <form onSubmit={handleSubmit}>
        <div className="mb-4">
          <label htmlFor="userId" className="block text-gray-700">
            User ID:
          </label>
          <input
            type="text"
            id="userId"
            value={params.id}
            onChange={handleUserIdChange}
            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-100"
          />
        </div>
        <div className="mb-4">
          <label className="block text-gray-700 font-semibold">Select Roles:</label>
          {roles &&
            Array.isArray(roles) &&
            roles.map((role) => (
              <div key={role.id} className="">
                <input
                  type="checkbox"
                  id={role.name}
                  value={role.name}
                  checked={selectedRoles.includes(role.name)}
                  onChange={handleRoleChange}
                  className="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                />
                <label htmlFor={role.name} className="ml-2 font-semibold">
                  {role.name}
                </label>
                <div>
                  <label className="block text-gray-700">Permissions:</label>
                  {role.permission &&
                    Array.isArray(role.permission) &&
                    role.permission.map((permission) => (
                      <span
                        className="text-white text-xs bg-blue-500 rounded-md px-1 py-1 inline-block m-1"
                        key={permission.id}
                      >
                        {permission.name}
                      </span>
                    ))}
                </div>
              </div>
            ))}
        </div>
        <button type="submit" className="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
          Update User Role
        </button>
      </form>
    </div>
  );
};

export default EditUserRoleForm;
