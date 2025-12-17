import Form from "./components/Form/Form";
import Header from "./components/Header";
import Table from "./components/Table/Table";

export default function App() {
  return (
    <div className="bg-white h-screen flex flex-col">
      <Header />
      <div className="flex flex-col px-page-default py-20 gap-y-20">
        <Form />
        <hr className="border-zinc-400" />
        <Table />
      </div>
    </div>
  );
}
