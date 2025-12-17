import { useState } from "react";
import type { UseFormRegister, RegisterOptions } from "react-hook-form";
import type { ContatoDetailsJSON } from "../../interfaces/Contato";

interface InputTextProps {
  id: string;
  label: string;
  placeholder: string;
  isDate?: boolean;
  register: UseFormRegister<ContatoDetailsJSON>;
  registerName: keyof ContatoDetailsJSON;
  maxLength?: number;
  rules?: RegisterOptions<ContatoDetailsJSON>;
  error?: string;
  mask?: (value: string) => string;
  minLength?: number;
}

export default function InputText({
  id,
  label,
  placeholder,
  isDate = false,
  register,
  registerName,
  rules,
  error,
  maxLength,
  mask,
  minLength,
}: InputTextProps) {
  const [focused, setFocused] = useState(false);

  return (
    <div className="flex flex-col">
      <label
        htmlFor={id}
        className={`cursor-pointer text-lg font-medium transition-colors w-fit ${
          error ? "text-red-500" : focused ? "text-primary" : "text-zinc-500"
        }`}
      >
        {label}
      </label>

      <input
        id={id}
        type={isDate ? "date" : "text"}
        placeholder={placeholder}
        aria-invalid={!!error}
        className={`outline-none border-b-2 text-xl/12 transition-colors ${
          error
            ? "border-red-500 text-red-600"
            : focused
            ? "border-primary text-zinc-800"
            : "border-zinc-400 text-zinc-800"
        }`}
        {...register(registerName, {
          ...rules,
          onChange: (e) => {
            if (!mask) return;
            e.target.value = mask(e.target.value);
          },
        })}
        onFocus={() => setFocused(true)}
        onBlur={() => setFocused(false)}
        maxLength={maxLength}
        minLength={minLength}
      />

      {error && <span className="text-sm text-red-500 mt-1">{error}</span>}
    </div>
  );
}
