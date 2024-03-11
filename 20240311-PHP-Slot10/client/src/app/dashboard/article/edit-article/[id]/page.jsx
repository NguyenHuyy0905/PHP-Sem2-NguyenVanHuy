"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import { toast } from "react-toastify";

const EditArticleForm = ({ params }) => {
  const [formData, setFormData] = useState({
    title: "",
    author: "",
    detail: "",
    category_id: "1", // Assuming category_id is a required field with default value 1
  });

  useEffect(() => {
    // Fetch article data to populate the form
    axios
      .get("/articles/" + params.id)
      .then((response) => {
        const { title, author, detail, category_id } = response.data.data;
        setFormData({
          title: title,
          author: author,
          detail: detail,
          category_id: category_id,
        });
      })
      .catch((error) => {
        console.error("Failed to fetch article data:", error);
      });
  }, []);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.put("/articles/" + params.id, formData, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      toast.success("Article updated successfully");
      console.log("Article updated successfully:", response.data);
    } catch (error) {
      console.error("Error updating article:", error);
      toast.error("User does not have the right permissions");
    }
  };

  return (
    <form onSubmit={handleSubmit} className="max-w-md mx-auto p-6 bg-white shadow-md rounded-md">
      <div className="space-y-4">
        <div>
          <label htmlFor="title" className="block mb-1">
            Title:
          </label>
          <input
            id="title"
            type="text"
            name="title"
            value={formData.title}
            onChange={handleChange}
            required
            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
          />
        </div>
        <div>
          <label htmlFor="author" className="block mb-1">
            Author:
          </label>
          <input
            id="author"
            type="text"
            name="author"
            value={formData.author}
            onChange={handleChange}
            required
            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
          />
        </div>
        <div>
          <label htmlFor="detail" className="block mb-1">
            Detail:
          </label>
          <textarea
            id="detail"
            name="detail"
            value={formData.detail}
            onChange={handleChange}
            required
            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
          ></textarea>
        </div>
        <div>
          <label htmlFor="category_id" className="block mb-1">
            Category ID:
          </label>
          <input
            id="category_id"
            type="text"
            name="category_id"
            value={formData.category_id}
            onChange={handleChange}
            required
            className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
          />
        </div>
        <button
          type="submit"
          className="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
        >
          Update Article
        </button>
      </div>
    </form>
  );
};

export default EditArticleForm;
