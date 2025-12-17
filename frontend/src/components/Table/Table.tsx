import { useEffect, useState } from "react";
import { obterTodosContatos } from "../../services/contatosApi";
import TableRow from "./TableRow";
import type { Contato } from "../../interfaces/Contato";

export default function Table() {
  const [contatos, setContatos] = useState<Contato[] | null>(null);

  useEffect(() => {
    async function load() {
      const response = await obterTodosContatos();
      setContatos(response);
    }
    load();
  }, []);

  return (
    <div>
      <table className="w-full shadow-md table-fixed">
        <thead className="bg-primary text-white h-10">
          <tr>
            <th>Nome</th>
            <th>Data de nascimento</th>
            <th>E-mail</th>
            <th>Celular para contato</th>
            <th className="w-1/6">Ações</th>
          </tr>
        </thead>
        <tbody className="divide-y divide-zinc-400">
          {contatos?.map((contato) => {
            return (
              <TableRow
                celular={contato.celular}
                dataNascimento={contato.dataNascimento}
                email={contato.email}
                nome={contato.nome}
                key={contato.id}
              />
            );
          })}
        </tbody>
      </table>
    </div>
  );
}
