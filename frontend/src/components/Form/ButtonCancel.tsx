import type { UseFormReset } from "react-hook-form";
import type { ContatoDetailsJSON } from "../../interfaces/Contato";

interface ButtonProps {
  setDadosIniciais: (arg0: ContatoDetailsJSON) => void;
  setEditando: (arg0: boolean) => void;
  reset: UseFormReset<ContatoDetailsJSON>;
}

export default function ButtonCancel({
  setDadosIniciais,
  setEditando,
  reset,
}: ButtonProps) {
  return (
    <button
      onClick={() => {
        setDadosIniciais({
          id: 0,
          nome: "",
          data_nascimento: "",
          email: "",
          profissao: "",
          telefone: "",
          celular: "",
          celular_com_whatsapp: false,
          notificacao_por_email: false,
          notificacao_por_sms: false,
        });
        setEditando(false);
        reset();
      }}
      type="submit"
      className="bg-white w-fit text-primary border border-primary font-medium text-lg px-3 py-2 rounded-md hover:bg-zinc-50 transition hover:scale-submit cursor-pointer active:scale-95"
    >
      Cancelar
    </button>
  );
}
