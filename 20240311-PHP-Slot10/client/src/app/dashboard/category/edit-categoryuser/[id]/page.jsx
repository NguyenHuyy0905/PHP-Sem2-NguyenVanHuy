"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import { toast } from "react-toastify";

const AddUserToCategoryForm = ({ params }) => {
  const [userId, setUserId] = useState("");
  const [users, setUsers] = useState([]);

  useEffect(() => {
    const fetchUsers = async () => {
      try {
        const response = await axios.get("/auth/index");
        console.log(response.data);
        setUsers(response.data);
      } catch (error) {
        toast.error("Error fetching users");
      }
    };
    fetchUsers();
  }, []);

  const handleUserIdChange = (e) => {
    setUserId(e.target.value);
  };
  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post("/categoryusers", {
        categoryId: params.id,
        userId: userId,
      });
      toast.success("User added to category successfully");
    } catch (error) {
      toast.error("User does not have the right permissions");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="max-w-md mx-auto">
      <div className="mb-4">
        <label htmlFor="categoryId" className="block text-gray-700">
          Category ID:
        </label>
        <input
          type="text"
          id="categoryId"
          value={params.id}
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
          readOnly
        />
      </div>
      <div className="mb-4">
        <label htmlFor="userId" className="block text-gray-700">
          Select User:
        </label>
        <select
          id="userId"
          value={userId}
          onChange={handleUserIdChange}
          className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
        >
          <option value="">Select a user</option>
          {users.map((user) => (
            <option key={user.user.user.id} value={user.user.user.id}>
              ID: {user.user.user.id}, Name: {user.user.user.name}
            </option>
          ))}
        </select>
      </div>
      <button type="submit" className="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
        Add User to Category
      </button>
    </form>
  );
};

export default AddUserToCategoryForm;
