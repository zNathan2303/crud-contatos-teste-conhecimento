import TableRow from "./TableRow";

export default function Table() {
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
          <TableRow
            nome="Letícia Pacheco"
            dataNascimento="03/10/2003"
            email="leticia@gmail.com"
            celular="(11) 98493-2039"
          />
          <TableRow
            nome="Letícia Pacheco"
            dataNascimento="03/10/2003"
            email="leticia@gmail.com"
            celular="(11) 98493-2039"
          />
          <TableRow
            nome="Letícia Pacheco"
            dataNascimento="03/10/2003"
            email="leticia@gmail.com"
            celular="(11) 98493-2039"
          />
        </tbody>
      </table>
    </div>
  );
}
