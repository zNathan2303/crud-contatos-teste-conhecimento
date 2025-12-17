import { useEffect } from "react";
import type { ContatoDetailsJSON } from "../../interfaces/Contato";
import { atualizarContato, criarContato } from "../../services/contatosApi";
import { maskTelefone } from "../../utils/masks";
import ButtonSubmit from "./ButtonSubmit";
import Checkbox from "./Checkbox";
import InputText from "./InputText";
import { useForm } from "react-hook-form";
import ButtonSave from "./ButtonSave";

interface FormProps {
  onSuccess: () => void;
  dadosIniciais: ContatoDetailsJSON;
  editando: boolean;
  setDadosIniciais: (arg0: ContatoDetailsJSON) => void;
  setEditando: (arg0: boolean) => void;
}

export default function Form({
  onSuccess,
  dadosIniciais,
  editando,
  setDadosIniciais,
  setEditando,
}: FormProps) {
  const {
    register,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm<ContatoDetailsJSON>({
    mode: "onChange",
  });

  useEffect(() => {
    reset(dadosIniciais);
  }, [dadosIniciais, reset]);

  async function onSubmit(data: ContatoDetailsJSON) {
    const payload: ContatoDetailsJSON = {
      ...data,
      id: dadosIniciais.id,
      telefone: data.telefone ? data.telefone.replace(/\D/g, "") : undefined,
      celular: data.celular.replace(/\D/g, ""),
    };
    if (editando) {
      await atualizarContato(payload);
    } else {
      await criarContato(payload);
    }
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
          rules={{
            required: "Nome é obrigatório",
            maxLength: {
              value: 100,
              message: "Máximo de 100 caracteres",
            },
          }}
          error={errors.nome?.message}
          maxLength={100}
        />
        <InputText
          id="data-nascimento"
          label="Data de nascimento"
          placeholder="Ex.: 03/10/2003"
          isDate
          register={register}
          registerName="data_nascimento"
          rules={{
            required: "Data de nascimento é obrigatória",
          }}
          error={errors.data_nascimento?.message}
        />
        <InputText
          id="email"
          label="Email"
          placeholder="Ex.: leticia@email.com"
          register={register}
          registerName="email"
          rules={{
            required: "Email é obrigatório",
            pattern: {
              value: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
              message: "E-mail inválido",
            },
            maxLength: {
              value: 255,
              message: "Máximo de 255 caracteres",
            },
          }}
          error={errors.email?.message}
          maxLength={255}
        />
        <InputText
          id="profissao"
          label="Profissão"
          placeholder="Ex.: Desenvolvedora Web"
          register={register}
          registerName="profissao"
          rules={{
            maxLength: {
              value: 100,
              message: "Máximo de 100 caracteres",
            },
          }}
          error={errors.profissao?.message}
          maxLength={100}
        />
        <InputText
          id="telefone"
          label="Telefone para contato"
          placeholder="Ex.: (11) 4033-2019"
          register={register}
          registerName="telefone"
          mask={maskTelefone}
          rules={{
            validate: (value) => {
              const numeros =
                typeof value === "string" ? value.replace(/\D/g, "") : "";

              if (numeros.length === 0) return true;

              return (
                numeros.length === 10 ||
                "O telefone deve conter exatamente 10 números"
              );
            },
          }}
          error={errors.telefone?.message}
          maxLength={14}
        />
        <InputText
          id="celular"
          label="Celular para contato"
          placeholder="Ex.: (11) 98493-2039"
          register={register}
          registerName="celular"
          mask={maskTelefone}
          rules={{
            required: "Celular é obrigatório",
            validate: (value) => {
              const numeros =
                typeof value === "string" ? value.replace(/\D/g, "") : "";

              return (
                numeros.length === 11 || "O celular deve conter 11 números"
              );
            },
          }}
          error={errors.celular?.message}
          maxLength={15}
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
        {editando ? <ButtonSave /> : <ButtonSubmit />}
      </div>
    </form>
  );
}
