"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import Link from "next/link";
import { toast } from "react-toastify";

const AddCategoryForm = () => {
  const [name, setName] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post("/categories", { name });
      toast.success("Category added successfully");
    } catch (error) {
      toast.error("User does not have the right permissions");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="max-w-md mx-auto p-6 bg-white shadow-md rounded-md">
      <div className="mb-4">
        <label htmlFor="name" className="block text-sm font-medium text-gray-700">
          Name:
        </label>
        <input
          id="name"
          type="text"
          value={name}
          onChange={(e) => setName(e.target.value)}
          className="mt-1 p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:border-blue-500"
          placeholder="Enter category name"
          required
        />
      </div>
      <button
        type="submit"
        className="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
      >
        Add Category
      </button>
    </form>
  );
};

export default AddCategoryForm;
