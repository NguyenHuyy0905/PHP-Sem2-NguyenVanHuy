"use client";
import NavBarReponsive from "@/components/NavBarReponsive";
import Footer from "@/components/Footer";
import axios from "@/utils/axios";
import Link from "next/link";
import React, { useState, useEffect } from "react";

export default function Home() {
  const [articles, setArticles] = useState([]);

  useEffect(() => {
    const fetchArticles = async () => {
      try {
        const response = await axios.get("/articles");
        setArticles(response.data.data);
      } catch (error) {
        console.error("Failed to fetch articles:", error);
      }
    };
    fetchArticles();
  }, []);
  return (
    <>
      <div className="max-w-6xl mx-auto ">
        <NavBarReponsive />
        <aside aria-label="Related articles" className="py-8lg:py-24 bg-gray-50 dark:bg-gray-800">
          <div className="px-4 ">
            <h2 className="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
            <div className="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
              {articles.map((article) => (
                <article className="max-w-xs" key={article.id}>
                  <Link href="/dashboard/users">
                    <img
                      src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png"
                      className="mb-5 rounded-lg"
                      alt="Image 1"
                    />
                  </Link>
                  <h2 className="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                    <a href="#">{article.title}</a>
                  </h2>
                  <p className="mb-4 text-gray-500 dark:text-gray-400">{article.detail}</p>
                  <a
                    href="#"
                    className="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline"
                  >
                    {article.author}
                  </a>
                </article>
              ))}
            </div>
          </div>
        </aside>
        <br />
      </div>
      <Footer />
    </>
  );
}
