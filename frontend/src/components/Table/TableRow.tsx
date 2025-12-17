import { apagarContato } from "../../services/contatosApi";

interface TableRowProps {
  nome: string;
  dataNascimento: string;
  email: string;
  celular: string;
  id: number;
  onDelete: () => void;
}

export default function TableRow({
  nome,
  dataNascimento,
  email,
  celular,
  id,
  onDelete,
}: TableRowProps) {
  async function excluirContato(id: number) {
    await apagarContato(id);
    onDelete();
  }

  return (
    <tr className="h-12">
      <td className="text-center text-zinc-600 truncate px-1.5">{nome}</td>
      <td className="text-center text-zinc-600 truncate px-1.5">
        {dataNascimento}
      </td>
      <td className="text-center text-zinc-600 truncate px-1.5">{email}</td>
      <td className="text-center text-zinc-600 truncate px-1.5">{celular}</td>
      <td className="m-auto">
        <div className="flex justify-center items-center gap-4 w-full h-full">
          <button className="cursor-pointer hover:scale-110 active:scale-95 transition-transform">
            <img src="./src/assets/editar.png" alt="editar" />
          </button>
          <button
            onClick={() => excluirContato(id)}
            className="cursor-pointer hover:scale-110 active:scale-95 transition-transform"
          >
            <img src="./src/assets/excluir.png" alt="excluir" />
          </button>
        </div>
      </td>
    </tr>
  );
}
