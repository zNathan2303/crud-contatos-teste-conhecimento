import type {
  Contato,
  ContatoDetailsJSON,
  ContatoJSON,
} from "../interfaces/Contato";
import { formatCellPhone, formatDate } from "../utils/formatter";

export async function obterTodosContatos(): Promise<Contato[]> {
  const url = "http://localhost:8080/contatos";
  const response = await fetch(url);
  const data: ContatoJSON[] = await response.json();
  const contatos = data.map(contatoConvert);
  return contatos;
}

export async function criarContato(contato: ContatoDetailsJSON) {
  const url = "http://localhost:8080/contatos";
  const options = {
    method: "POST",
    headers: { "content-type": "application/json" },
    body: JSON.stringify(contato),
  };

  await fetch(url, options);
}

export async function apagarContato(id: number) {
  const url = `http://localhost:8080/contatos/${id}`;
  const options = {
    method: "DELETE",
  };

  await fetch(url, options);
}

export async function obterContatoPorId(
  id: number
): Promise<ContatoDetailsJSON> {
  const url = `http://localhost:8080/contatos/${id}`;
  const response = await fetch(url);
  const contato: ContatoDetailsJSON = await response.json();

  return contato;
}

export async function atualizarContato(contato: ContatoDetailsJSON) {
  const url = `http://localhost:8080/contatos/${contato.id}`;
  const options = {
    method: "PUT",
    headers: { "content-type": "application/json" },
    body: JSON.stringify(contato),
  };

  await fetch(url, options);
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
