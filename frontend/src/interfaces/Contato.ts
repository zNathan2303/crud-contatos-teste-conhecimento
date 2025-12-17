export interface Contato {
  id: number;
  nome: string;
  dataNascimento: string;
  email: string;
  celular: string;
}

export interface ContatoJSON {
  id: number;
  nome: string;
  data_nascimento: string;
  email: string;
  celular: string;
}

export interface ContatoDetailsJSON {
  id: number;
  nome: string;
  data_nascimento: string;
  email: string;
  profissao?: string;
  telefone?: string;
  celular: string;
  celular_com_whatsapp?: boolean;
  notificacao_por_email?: boolean;
  notificacao_por_sms?: boolean;
}
