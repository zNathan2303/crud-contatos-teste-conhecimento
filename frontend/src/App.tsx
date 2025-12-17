import Form from "./components/Form/Form";
import Header from "./layout/Header";
import Table from "./components/Table/Table";
import Footer from "./layout/Footer";
import { useEffect, useState } from "react";
import type { Contato } from "./interfaces/Contato";
import { obterTodosContatos } from "./services/contatosApi";

export default function App() {
  const [contatos, setContatos] = useState<Contato[]>([]);

  async function carregarContatos() {
    const response = await obterTodosContatos();
    setContatos(response);
  }

  useEffect(() => {
    async function load() {
      await carregarContatos();
    }
    load();
  }, []);

  return (
    <div className="bg-white h-screen flex flex-col">
      <Header />
      <div className="flex flex-col px-page-default pt-20 pb-40 gap-y-20">
        <Form onSuccess={carregarContatos} />
        <hr className="border-zinc-400 w-divide-line" />
        <Table contatos={contatos} />
      </div>
      <Footer />
    </div>
  );
}
