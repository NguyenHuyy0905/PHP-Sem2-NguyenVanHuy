"use client";
import React, { useState, useEffect, useContext } from "react";
import { useRouter } from "next/navigation";
import jwtDecode from "jwt-decode";
import Link from "next/link";
import { AuthContext } from "@/components/User/AuthProvider";

export default function NavBarReponsive() {
  const { isLoggedIn, username, user, handleLogout } = useContext(AuthContext);

  const [openNav, setOpenNav] = useState(false);
  const [dropDown, setDropDown] = useState(false);

  const handleDropDown = () => {
    setDropDown(!dropDown);
  };

  const handleNavBar = () => {
    setOpenNav(!openNav);
  };

  return (
    <>
      <nav
        className={`max-w-6xl mx-auto fixed top-0 shadow-md lg:bg-opacity-80 bg-gray-50 z-20 px-5 font-semibold text-gray-600 transition-all w-full duration-500 backdrop-blur-md  ${
          openNav ? " top-0 bg-white" : ""
        }`}
      >
        <div className=" relative flex justify-between py-2 lg:flex-row lg:items-center lg:space-x-10">
          {/* Start Navbar Mobile */}
          <div className="flex items-center justify-between">
            <Link href="/">
              <img
                alt="Logo"
                loading="lazy"
                className="max-w-[60px] lg:max-w-[100px]"
                decoding="async"
                data-nimg={1}
                style={{ color: "transparent" }}
                src="https://assets.eflorist.com/site/EF-12198/Logo/Plant-Palace_Primary-Logo.png"
              />
            </Link>
            <div className="lg:hidden mx-5"></div>
            <div className="flex items-center space-x-2 lg:hidden">
              <Link
                className="rounded-sm border border-secondary-100 p-1.5 transition duration-300 hover:border-primary-100 hover:bg-primary-100 hover:text-white"
                href="/products/my-cart"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24px"
                  height="24px"
                  viewBox="0 0 24 24"
                  role="presentation"
                  style={{ height: 21 }}
                >
                  <g transform="translate(2 2.5)">
                    <path
                      d="M.764,0A.765.765,0,1,1,0,.765.766.766,0,0,1,.764,0Z"
                      transform="translate(4.658 17.32)"
                      fill="none"
                      stroke="currentColor"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeMiterlimit={10}
                      strokeWidth="1.5px"
                    />
                    <path
                      d="M.765,0A.765.765,0,1,1,0,.765.766.766,0,0,1,.765,0Z"
                      transform="translate(15.91 17.32)"
                      fill="none"
                      stroke="currentColor"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeMiterlimit={10}
                      strokeWidth="1.5px"
                    />
                    <path
                      d="M0,0,2.08.36l.963,11.473a1.8,1.8,0,0,0,1.8,1.653H15.752a1.8,1.8,0,0,0,1.785-1.546l.949-6.558a1.341,1.341,0,0,0-1.327-1.533H2.414"
                      transform="translate(0.75 0.75)"
                      fill="none"
                      stroke="currentColor"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeMiterlimit={10}
                      strokeWidth="1.5px"
                    />
                    <path
                      d="M0,.5H2.773"
                      transform="translate(12.125 7.795)"
                      fill="none"
                      stroke="currentColor"
                      strokeLinecap="round"
                      strokeLinejoin="round"
                      strokeMiterlimit={10}
                      strokeWidth="1.5px"
                    />
                  </g>
                </svg>
              </Link>
              <button
                onClick={handleNavBar}
                className="rounded-sm border border-secondary-100 px-3 py-1.5 transition duration-300 hover:border-primary-100 hover:bg-primary-100 "
              >
                {openNav ? (
                  <svg
                    stroke="currentColor"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                    height="21px"
                    width="21px"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      clipRule="evenodd"
                      d="M8 8.707l3.646 3.647.708-.707L8.707 8l3.647-3.646-.707-.708L8 7.293 4.354 3.646l-.707.708L7.293 8l-3.646 3.646.707.708L8 8.707z"
                    ></path>
                  </svg>
                ) : (
                  <svg
                    stroke="currentColor"
                    fill="currentColor"
                    strokeWidth={0}
                    viewBox="0 0 16 16"
                    height="21px"
                    width="21px"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path d="M16 5H0V4h16v1zm0 8H0v-1h16v1zm0-4.008H0V8h16v.992z" />
                  </svg>
                )}
              </button>
            </div>
          </div>
          {/* End Navbar Mobile */}

          <div className="hidden lg:block"></div>
          <div
            className={`h-0 flex flex-col ${
              openNav ? "h-[330px] " : "overflow-hidden"
            } z-10 transition-all duration-300 lg:h-full lg:flex-row lg:items-center`}
          >
            {isLoggedIn ? (
              <>
                <div>
                  <button
                    id="dropdownInformationButton"
                    data-dropdown-toggle="dropdownInformation"
                    className=" bg-white border border-emerald-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center hover:bg-emerald-300 "
                    type="button"
                    onClick={handleDropDown}
                  >
                    {username}{" "}
                    <div className="icon relative">
                      <img
                        className="max-w-[30px] rounded-full ml-2"
                        src="https://i.pinimg.com/564x/7e/05/70/7e0570da0f3fcef0832ea3bc82eb41b1.jpg"
                        alt=""
                      />
                      <svg
                        className="w-3 h-3 ml-2.5 absolute right-0 bottom-0 bg-slate-400 rounded-full p-0.5 border border-white "
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 10 6"
                      >
                        <path
                          stroke="currentColor"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          strokeWidth={2}
                          d="m1 1 4 4 4-4"
                        />
                      </svg>
                    </div>
                  </button>

                  {dropDown && (
                    <div
                      id="dropdownInformation"
                      className="z-10 absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                    >
                      <Link href="/user/profile">
                        <div className="px-4 py-3 text-sm text-gray-900 dark:text-white hover:bg-gray-100">
                          <div>Hello: {username}</div>
                        </div>
                      </Link>

                      <ul
                        className="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownInformationButton"
                      >
                        <li>
                          <Link
                            href="/dashboard/users"
                            className="block px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                          >
                            DashBoard
                          </Link>
                        </li>
                        <li>
                          <Link
                            href="/dashboard/users"
                            className="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                          >
                            Article
                          </Link>
                        </li>
                      </ul>
                      <div className="py-2">
                        <Link
                          href="#"
                          className="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                        >
                          <button onClick={handleLogout}>Log out</button>
                        </Link>
                      </div>
                    </div>
                  )}
                </div>
              </>
            ) : (
              <div className="flex group items-center border-secondary-100 bg-transparent text-secondary-100 hover:border-primary-100 hover:bg-emerald-300  text-body-2-medium mt-6 rounded-[32px] border px-6 py-[10px] text-center transition duration-300 lg:mt-0 cursor-pointer">
                <svg
                  className="mr-2 fill-slate-600 group-hover:fill-white"
                  xmlns="http://www.w3.org/2000/svg"
                  height="1em"
                  viewBox="0 0 448 512"
                >
                  <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z" />
                </svg>
                <Link className="group-hover:text-white" href="/user/login">
                  Login
                </Link>
              </div>
            )}
          </div>
        </div>
      </nav>
      <div className="h-[77.3px]"></div>
    </>
  );
}
