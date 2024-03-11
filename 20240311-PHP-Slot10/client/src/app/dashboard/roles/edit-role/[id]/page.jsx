"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import { toast } from "react-toastify";

const EditRoleForm = ({ params }) => {
  const [roleData, setRoleData] = useState({ id: "", name: "", permissions: [] });
  const [allPermissions, setAllPermissions] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const roleResponse = await axios.get(`/roles/${params.id}`);
        const permissionResponse = await axios.get("/permissions");
        const { id, name, permission } = roleResponse.data.data;
        setRoleData({ id, name, permissions: permission.map((p) => p.name) });
        setAllPermissions(permissionResponse.data.permissions.map((p) => p.name));
      } catch (error) {
        console.error("Failed to fetch data:", error);
      }
    };

    fetchData();
  }, [params.id]);

  const handleNameChange = (e) => {
    setRoleData({ ...roleData, name: e.target.value });
  };

  const handlePermissionChange = (e) => {
    const permission = e.target.value;
    const isChecked = e.target.checked;
    if (isChecked) {
      setRoleData({ ...roleData, permissions: [...roleData.permissions, permission] });
    } else {
      setRoleData({ ...roleData, permissions: roleData.permissions.filter((item) => item !== permission) });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const newData = {
      name: roleData.name,
      permission: roleData.permissions,
    };

    try {
      await axios.put(`/roles/${roleData.id}`, newData);
      toast.success("Role updated successfully");
      console.log("Role updated successfully");
    } catch (error) {
      toast.error("Failed to update role");
      console.error("Failed to update role:", error);
    }
  };

  return (
    <form onSubmit={handleSubmit} className="max-w-md mx-auto">
      <div className="mb-4">
        <label htmlFor="roleId" className="block text-gray-700">
          ID:
        </label>
        <input
          type="text"
          id="roleId"
          value={roleData.id}
          disabled
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-100"
        />
      </div>
      <div className="mb-4">
        <label htmlFor="roleName" className="block text-gray-700">
          Name:
        </label>
        <input
          type="text"
          id="roleName"
          value={roleData.name}
          onChange={handleNameChange}
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        />
      </div>
      <div className="mb-4">
        <label className="block text-gray-700">Permissions:</label>
        {allPermissions.map((permission) => (
          <div key={permission} className="flex items-center">
            <input
              type="checkbox"
              id={permission}
              value={permission}
              checked={roleData.permissions.includes(permission)}
              onChange={handlePermissionChange}
              className="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
            />
            <label htmlFor={permission} className="ml-2">
              {permission}
            </label>
          </div>
        ))}
      </div>
      <button type="submit" className="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        Update Role
      </button>
    </form>
  );
};

export default EditRoleForm;
