import Form from "./components/Form/Form";
import Header from "./components/Header";

export default function App() {
  return (
    <div className="bg-white h-screen flex flex-col">
      <Header />
      <div className="flex flex-col px-page-default pt-20">
        <Form />
      </div>
    </div>
  );
}
