import type { UseFormRegister } from "react-hook-form";
import type { ContatoDetailsJSON } from "../../interfaces/Contato";

interface CheckboxProps {
  id: string;
  label: string;
  register: UseFormRegister<ContatoDetailsJSON>;
  registerName: keyof ContatoDetailsJSON;
}

export default function Checkbox({
  id,
  label,
  register,
  registerName,
}: CheckboxProps) {
  return (
    <div className="flex items-center gap-4">
      <input
        {...register(registerName)}
        type="checkbox"
        id={id}
        className="size-5 cursor-pointer appearance-none rounded-md border-2 border-zinc-400 bg-transparent
        transition-all checked:bg-primary checked:border-primary checked:bg-checked"
      />
      <label htmlFor={id} className="text-zinc-500 cursor-pointer">
        {label}
      </label>
    </div>
  );
}
