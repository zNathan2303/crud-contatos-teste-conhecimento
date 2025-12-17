export default function Footer() {
  return (
    <div className="bg-primary flex items-center px-page-default justify-evenly text-white font-light min-h-24">
      <a href="#" className="hover:text-shadow-2xs hover:text-shadow-white">
        Termos | Políticas
      </a>
      <span className="h-1/2 flex items-center justify-center gap-1">
        © Copyright 2022 | Desenvolvido por
        <a href="#" className="relative top-0.5">
          <img
            className="max-h-5"
            src="./src/assets/logo_rodape_alphacode.png"
            alt="logo-rodape-alphacode"
          />
        </a>
      </span>
      <span>©Alphacode IT Solutions 2022</span>
    </div>
  );
}
