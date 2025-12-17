import Form from "./components/Form/Form";
import Header from "./layout/Header";
import Table from "./components/Table/Table";
import Footer from "./layout/Footer";

export default function App() {
  return (
    <div className="bg-white h-screen flex flex-col">
      <Header />
      <div className="flex flex-col px-page-default pt-20 pb-40 gap-y-20">
        <Form />
        <hr className="border-zinc-400 w-divide-line" />
        <Table />
      </div>
      <Footer />
    </div>
  );
}
