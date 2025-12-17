import type { ContatoDetailsJSON } from "../../interfaces/Contato";
import { criarContato } from "../../services/contatosApi";
import ButtonSubmit from "./ButtonSubmit";
import Checkbox from "./Checkbox";
import InputText from "./InputText";
import { useForm } from "react-hook-form";

interface FormProps {
  onSuccess: () => void;
}

export default function Form({ onSuccess }: FormProps) {
  const { register, handleSubmit, reset } = useForm<ContatoDetailsJSON>();

  async function onSubmit(data: ContatoDetailsJSON) {
    await criarContato(data);
    reset();
    onSuccess();
  }

  return (
    <form className="flex flex-col gap-y-18" onSubmit={handleSubmit(onSubmit)}>
      <div className="grid grid-cols-2 gap-y-14 gap-x-20">
        <InputText
          id="nome"
          label="Nome completo"
          placeholder="Ex.: Letícia Pacheco dos Santos"
          register={register}
          registerName="nome"
        />
        <InputText
          id="data-nascimento"
          label="Data de nascimento"
          placeholder="Ex.: 03/10/2003"
          isDate
          register={register}
          registerName="data_nascimento"
        />
        <InputText
          id="email"
          label="Email"
          placeholder="Ex.: leticia@email.com"
          register={register}
          registerName="email"
        />
        <InputText
          id="profissao"
          label="Profissão"
          placeholder="Ex.: Desenvolvedora Web"
          register={register}
          registerName="profissao"
        />
        <InputText
          id="telefone"
          label="Telefone para contato"
          placeholder="Ex.: (11) 4033-2019"
          register={register}
          registerName="telefone"
        />
        <InputText
          id="celular"
          label="Celular para contato"
          placeholder="Ex.: (11) 98493-2039"
          register={register}
          registerName="celular"
        />
      </div>
      <div className="grid grid-cols-2 gap-y-8 gap-x-20">
        <Checkbox
          id="celular-com-whatsapp"
          label="Número de celular possui Whatsapp"
          register={register}
          registerName="celular_com_whatsapp"
        />
        <Checkbox
          id="notificacao-por-email"
          label="Enviar notificações por E-mail"
          register={register}
          registerName="notificacao_por_email"
        />
        <Checkbox
          id="notificacao-por-sms"
          label="Enviar notificações por SMS"
          register={register}
          registerName="notificacao_por_sms"
        />
      </div>
      <div className="w-full flex justify-end">
        <ButtonSubmit />
      </div>
    </form>
  );
}
