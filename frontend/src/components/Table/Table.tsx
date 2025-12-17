import TableRow from "./TableRow";
import type { Contato, ContatoDetailsJSON } from "../../interfaces/Contato";

interface TableProps {
  contatos: Contato[];
  onDelete: () => void;
  setDadosIniciais: (contato: ContatoDetailsJSON) => void;
}

export default function Table({
  contatos,
  onDelete,
  setDadosIniciais,
}: TableProps) {
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
          {contatos.map((contato) => {
            return (
              <TableRow
                id={contato.id}
                celular={contato.celular}
                dataNascimento={contato.dataNascimento}
                email={contato.email}
                nome={contato.nome}
                key={contato.id}
                onDelete={onDelete}
                setDadosIniciais={setDadosIniciais}
              />
            );
          })}
        </tbody>
      </table>
    </div>
  );
}
