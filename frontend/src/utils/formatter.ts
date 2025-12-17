export function formatDate(data: string): string {
  const [ano, mes, dia] = data.split("-");
  return `${dia}/${mes}/${ano}`;
}

export function formatCellPhone(celular: string): string {
  const numeros = celular.replace(/\D/g, "");

  const ddd = numeros.slice(0, 2);
  const numero = numeros.slice(2);

  return `(${ddd}) ${numero.slice(0, 5)}-${numero.slice(5)}`;
}
