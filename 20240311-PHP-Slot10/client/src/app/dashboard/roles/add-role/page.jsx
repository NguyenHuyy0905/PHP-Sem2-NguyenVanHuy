"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import { toast } from "react-toastify";

const AddRoleForm = () => {
  const [formData, setFormData] = useState({
    name: "",
    permission: [],
  });

  const [permissions, setPermissions] = useState([]);
  useEffect(() => {
    const fetchPermissions = async () => {
      try {
        const response = await axios.get("/permissions");
        setPermissions(response.data.permissions);
      } catch (error) {
        console.error("Failed to fetch permissions:", error);
      }
    };
    fetchPermissions();
  }, []);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleCheckboxChange = (e) => {
    const permission = e.target.value;
    const isChecked = e.target.checked;
    if (isChecked) {
      setFormData({
        ...formData,
        permission: [...formData.permission, permission],
      });
    } else {
      setFormData({
        ...formData,
        permission: formData.permission.filter((p) => p !== permission),
      });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("/roles", formData, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      toast.success("Role added successfully");
      console.log(response.data);
    } catch (error) {
      console.error("Error adding role:", error);
      toast.error("Error adding role:", error);
    }
  };

  return (
    <div className="max-w-md mx-auto">
      <h2 className="text-2xl font-bold mb-4">Add Role</h2>
      <form onSubmit={handleSubmit}>
        <div className="mb-4">
          <label htmlFor="name" className="block text-gray-700">
            Name:
          </label>
          <input
            type="text"
            id="name"
            name="name"
            value={formData.name}
            onChange={handleChange}
            required
            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-100"
          />
        </div>
        <div className="mb-4">
          <label className="block text-gray-700">Permissions:</label>
          {permissions.map((permission) => (
            <div key={permission.id} className="flex items-center">
              <input
                type="checkbox"
                id={permission.name}
                name={permission.name}
                value={permission.name}
                onChange={handleCheckboxChange}
                className="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
              />
              <label htmlFor={permission.name} className="ml-2">
                {permission.name}
              </label>
            </div>
          ))}
        </div>
        <button type="submit" className="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
          Submit
        </button>
      </form>
    </div>
  );
};

export default AddRoleForm;
