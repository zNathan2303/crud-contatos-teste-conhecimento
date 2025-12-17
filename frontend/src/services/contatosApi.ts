import type { Contato, ContatoJSON } from "../interfaces/Contato";
import { formatCellPhone, formatDate } from "../utils/formatter";

export async function obterTodosContatos(): Promise<Contato[]> {
  const url = "http://localhost:8080/contatos";
  const response = await fetch(url);
  const data: ContatoJSON[] = await response.json();
  const contatos = data.map(contatoConvert);
  return contatos;
}

function contatoConvert(json: ContatoJSON): Contato {
  return {
    id: json.id,
    nome: json.nome,
    dataNascimento: formatDate(json.data_nascimento),
    email: json.email,
    celular: formatCellPhone(json.celular),
  };
}
