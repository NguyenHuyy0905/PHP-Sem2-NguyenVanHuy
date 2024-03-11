import NavBarReponsive from "../../components/NavBarReponsive";
import Footer from "../../components/Footer";
export default function ProductsLayout({ children }) {
  return (
    <main className="max-w-6xl mx-auto">
      <NavBarReponsive />
      {children}
      <Footer />
    </main>
  );
}
