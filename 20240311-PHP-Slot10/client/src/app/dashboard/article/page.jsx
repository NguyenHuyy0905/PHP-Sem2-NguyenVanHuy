"use client";
import React, { useState, useEffect } from "react";
import axios from "@/utils/axios";
import Link from "next/link";
import { toast } from "react-toastify";

const ArticleTable = () => {
  const [articles, setArticles] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get("/articles"); // Replace with your actual API endpoint
        setArticles(response.data.data);
      } catch (error) {
        console.error("Error fetching article data:", error);
      }
    };

    fetchData();
  }, []);

  return (
    <div className="container mx-auto mt-8">
      <h1 className="text-2xl font-bold mb-4">Article List</h1>
      <Link
        href="/dashboard/article/add-article"
        className="bg-green-500 text-white px-4 py-2 rounded-md font-bold transition duration-300 hover:bg-green-600 mb-5 inline-block"
      >
        Add Article
      </Link>
      <table className="min-w-full table-auto">
        <thead>
          <tr>
            <th className="border border-gray-300 px-4 py-2">ID</th>
            <th className="border border-gray-300 px-4 py-2">Title</th>
            <th className="border border-gray-300 px-4 py-2">Author</th>
            <th className="border border-gray-300 px-4 py-2">Detail</th>
            <th className="border border-gray-300 px-4 py-2">User ID</th>
            <th className="border border-gray-300 px-4 py-2">Category ID</th>
            <th className="border border-gray-300 px-4 py-2">Created At</th>
            <th className="border border-gray-300 px-4 py-2">Updated At</th>
            <th className="border border-gray-300 px-4 py-2">Edit</th>
          </tr>
        </thead>
        <tbody>
          {articles.map((article) => (
            <tr key={article.id}>
              <td className="border border-gray-300 px-4 py-2">{article.id}</td>
              <td className="border border-gray-300 px-4 py-2">{article.title}</td>
              <td className="border border-gray-300 px-4 py-2">{article.author}</td>
              <td className="border border-gray-300 px-4 py-2">{article.detail}</td>
              <td className="border border-gray-300 px-4 py-2">{article.user_id}</td>
              <td className="border border-gray-300 px-4 py-2">{article.category_id}</td>
              <td className="border border-gray-300 px-4 py-2">{article.created_at}</td>
              <td className="border border-gray-300 px-4 py-2">{article.updated_at}</td>
              <Link href={`/dashboard/article/edit-article/${article.id}`}>
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
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default ArticleTable;
