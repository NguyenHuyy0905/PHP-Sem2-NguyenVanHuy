import "./globals.css";
import "react-toastify/dist/ReactToastify.css";
import { Inter } from "next/font/google";
import AuthProvider from "@/components/User/AuthProvider";
import { ToastContainer } from "react-toastify";

const inter = Inter({ subsets: ["latin"] });

export const metadata = {
  title: "Team Atom",
  description: "Team Atom",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={inter.className}>
        <div className=" px-5 relative">
          <ToastContainer />
          <AuthProvider>{children}</AuthProvider>
        </div>
      </body>
    </html>
  );
}
