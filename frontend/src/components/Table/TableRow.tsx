interface TableRowProps {
  nome: string;
  dataNascimento: string;
  email: string;
  celular: string;
}

export default function TableRow({
  nome,
  dataNascimento,
  email,
  celular,
}: TableRowProps) {
  return (
    <tr className="h-12">
      <td className="text-center text-zinc-600 truncate">{nome}</td>
      <td className="text-center text-zinc-600 truncate">{dataNascimento}</td>
      <td className="text-center text-zinc-600 truncate">{email}</td>
      <td className="text-center text-zinc-600 truncate">{celular}</td>
      <td className="m-auto">
        <div className="flex justify-center items-center gap-4 w-full h-full">
          <button className="cursor-pointer hover:scale-110 active:scale-95 transition-transform">
            <img src="./src/assets/editar.png" alt="editar" />
          </button>
          <button className="cursor-pointer hover:scale-110 active:scale-95 transition-transform">
            <img src="./src/assets/excluir.png" alt="excluir" />
          </button>
        </div>
      </td>
    </tr>
  );
}
