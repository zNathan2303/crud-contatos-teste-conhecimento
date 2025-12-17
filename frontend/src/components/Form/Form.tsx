import Checkbox from "./Checkbox";
import InputText from "./InputText";

export default function Form() {
  return (
    <form className="flex flex-col gap-y-18">
      <div className="grid grid-cols-2 gap-y-14 gap-x-20">
        <InputText
          id="nome"
          label="Nome completo"
          placeholder="Ex.: Letícia Pacheco dos Santos"
        />
        <InputText
          id="data-nascimento"
          label="Data de nascimento"
          placeholder="Ex.: 03/10/2003"
        />
        <InputText
          id="email"
          label="Email"
          placeholder="Ex.: leticia@email.com"
        />
        <InputText
          id="profissao"
          label="Profissão"
          placeholder="Ex.: Desenvolvedora Web"
        />
        <InputText
          id="telefone"
          label="Telefone para contato"
          placeholder="Ex.: (11) 4033-2019"
        />
        <InputText
          id="celular"
          label="Celular para contato"
          placeholder="Ex.: (11) 98493-2039"
        />
      </div>
      <div className="grid grid-cols-2 gap-y-8 gap-x-20">
        <Checkbox
          id="celular-possui-whatsapp"
          label="Número de celular possui Whatsapp"
        />
        <Checkbox
          id="notificacao-por-email"
          label="Enviar notificações por E-mail"
        />
        <Checkbox
          id="notificacao-por-sms"
          label="Enviar notificações por SMS"
        />
      </div>
    </form>
  );
}
